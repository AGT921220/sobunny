<script>
    (function($) {
        "use strict";
        $(document).ready(function() {


            $('#buyBitcoin').on('click', function() {
                // alert('You have purchased Bitcoin');

                Swal.fire(
                    'Loading',
                    'Generating payment address...',
                    'info'
                )
                Swal.showLoading();

                $.ajax({
                    url: '/user/payments',
                    method: 'POST',
                    data: {
                        membership_id: $('.membershipId').val(),
                    },
                    success: function(response) {
                        const data = response.success
                        Swal.close();
                        $('.red-global-close-btn').trigger('click');
                        $('#paymentModal').modal('show');

                        $('#direccionBitcoin').text(data.pay_address);
                        $('#montoBitcoin').text(data.pay_amount);



                        const qrCodeUrl =
                            `bitcoin:${data.pay_address}?amount=${data.pay_amount}`;
                        console.log(qrCodeUrl)
                        // Generar el QR usando qrcode.js
                        QRCode.toCanvas(document.getElementById('codigoQR'), qrCodeUrl,
                            function(error) {
                                if (error) console.error('Error al generar el QR:',
                                    error);
                                console.log('Código QR generado exitosamente');
                            });

                        // const qrCodeUrl = `bitcoin:${data.pay_address}?amount=${data.pay_amount}`;
                        // console.log(`https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=${encodeURIComponent(qrCodeUrl)}`)
                        //   $('#codigoQR').attr('src', `https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=${encodeURIComponent(qrCodeUrl)}`);

                    },
                    error: function(error) {
                        setTimeout(() => {
                            Swal.fire(
                            'Error',
                            'Could not generate payment address. Please try again.',
                            'error'
                        )                            
                        }, 500);
                    },
                });
            });




            // show membership current info in modal
            $(document).on('click', '.show_membership_payment_history_modal', function() {
                let membership_history_id = $(this).data('membership_history_id');
                let membership_type = $(this).data('membership_type');
                let membership_purchase_date_history = $(this).data(
                    'membership_purchase_date_history');
                let membership_expire_date_history = $(this).data('membership_expire_date_history');

                let listing_limit = $(this).data('listing_limit');
                let gallery_images = $(this).data('gallery_images');
                let featured_listing = $(this).data('featured_listing');
                let business_hour = $(this).data('business_hour');
                let enquiry_form = $(this).data('enquiry_form');
                let membership_badge = $(this).data('membership_badge');

                $('#membership_history_id').val(membership_history_id);
                $('#membership_type').text(membership_type);
                $('#membership_purchase_date_history').text(membership_purchase_date_history);
                $('#membership_expire_date_history').text(membership_expire_date_history);

                // listing limit
                if (listing_limit != 0) {
                    $('#listing_limit').html(listing_limit);
                } else {
                    $('#listing_limit').html(
                        '<i class="las la-times-circle text-danger fs-4 mx-2"></i>');
                }

                if (gallery_images != 0) {
                    $('#gallery_images').html(gallery_images);
                } else {
                    $('#gallery_images').html(
                        '<i class="las la-times-circle text-danger fs-4 mx-2"></i>');
                }

                if (featured_listing != 0) {
                    $('#featured_listing').html(featured_listing);
                } else {
                    $('#featured_listing').html(
                        '<i class="las la-times-circle text-danger fs-4 mx-2"></i>');
                }

                if (business_hour != 0) {
                    $('#business_hour').html(
                        '<i class="las la-check-circle text-success fs-4 mx-2"></i>');
                } else {
                    $('#business_hour').html(
                        '<i class="las la-times-circle text-danger fs-4 mx-2"></i>');
                }

                if (enquiry_form != 0) {
                    $('#enquiry_form').html(
                        '<i class="las la-check-circle text-success fs-4 mx-2"></i>');
                } else {
                    $('#enquiry_form').html(
                        '<i class="las la-times-circle text-danger fs-4 mx-2"></i>');
                }

                if (membership_badge != 0) {
                    $('#membership_badge').html(
                        '<i class="las la-check-circle text-success fs-4 mx-2"></i>');
                } else {
                    $('#membership_badge').html(
                        '<i class="las la-times-circle text-danger fs-4 mx-2"></i>');
                }

            });

        });
    }(jQuery));
</script>
