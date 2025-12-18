<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<button id="pay-button">Bayar Sekarang</button>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '/payment/finish';
        },
        onPending: function(result){
            window.location.href = '/payment/unfinish';
        },
        onError: function(result){
            window.location.href = '/payment/error';
        }
    });
};
</script>
