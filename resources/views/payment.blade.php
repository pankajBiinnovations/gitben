<!-- resources/views/payment.blade.php -->
<form action="/payment/process" method="post">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        data-key="{{ config('services.stripe.key') }}"
        data-amount="999"
        data-name="Stripe Demo"
        data-description="Example payment"
        data-currency="usd"
    ></script>
</form>
