<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookStoreFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_home_page_lists_seeded_products(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Laravel Kitap Satis Sitesi')
            ->assertSee('Sefiller');
    }

    public function test_admin_login_redirects_to_admin_panel(): void
    {
        $admin = User::where('email', 'admin@metinkitap.test')->firstOrFail();

        $this->post(route('login.store'), [
            'email' => 'admin@metinkitap.test',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_user_can_checkout_and_cancel_pending_order_with_wallet_refund(): void
    {
        $user = User::where('email', 'mehmet@test.com')->firstOrFail();
        $product = Product::firstOrFail();
        $startingStock = $product->stock;

        $this->actingAs($user)
            ->post(route('cart.add'), [
                'product_id' => $product->id,
                'quantity' => 2,
            ])
            ->assertRedirect(route('cart.index'));

        $this->actingAs($user)
            ->post(route('checkout.store'), [
                'shipping_address' => 'Gebze / Kocaeli',
                'card_number' => '4111 1111 1111 1111',
                'cvv' => '123',
            ])
            ->assertRedirect(route('orders.index'));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertSame('pending', $order->status);
        $this->assertSame($startingStock - 2, $product->fresh()->stock);

        $this->actingAs($user)
            ->post(route('orders.cancel', $order))
            ->assertRedirect(route('orders.index'));

        $this->assertSame('cancelled', $order->fresh()->status);
        $this->assertSame($startingStock, $product->fresh()->stock);
        $this->assertEquals((float) $order->total_amount, (float) $user->fresh()->wallet_balance);
    }

    public function test_admin_can_advance_order_status(): void
    {
        $user = User::where('email', 'ayse@test.com')->firstOrFail();
        $admin = User::where('email', 'admin@metinkitap.test')->firstOrFail();
        $product = Product::firstOrFail();

        $this->actingAs($user)->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $this->actingAs($user)->post(route('checkout.store'), [
            'shipping_address' => 'Izmit / Kocaeli',
            'card_number' => '4111 1111 1111 1111',
            'cvv' => '123',
        ]);

        $order = Order::where('user_id', $user->id)->firstOrFail();

        $this->actingAs($admin)
            ->post(route('admin.orders.next', $order))
            ->assertRedirect(route('admin.dashboard'));

        $this->assertSame('approved', $order->fresh()->status);
    }
}

