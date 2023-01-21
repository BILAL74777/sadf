<template>
    <main id="main" class="main">
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->
</template>
<script>
import Master from "@/Pages/Backend/Layouts/Master";

export default {
    layout: Master,
    props: ["collection_id", "amount", "company"],
    created() {
        alert(this.company);
    },
    data() {
        return {};
    },

    methods: {},
};
paypal
    .Buttons({
        createOrder: function (data, actions) {
            var amounts = this.amount;
            return actions.order.create({
                purchase_units: [
                    {
                        amount: {
                            value: amounts,
                        },
                    },
                ],
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                alert("tsesting");
                var amounts = this.amount;
                var company = this.company;
                var collection_id = this.collection_id;

                // window.location.href='/save_order/'+amounts+'/'+company+'/'+details.status+'/'+details.payer.email_address+'/'+details.payer.name.given_name + ' ' + details.payer.name.surname+'/'+details.payer.payer_id+'/'+details.tansaction_id;

                // window.location.href='/save_order/'+amounts+'/'+company+'/'+collection_id+'/'+details.status+'/'+details.payer.email_address+'/'+details.payer.name.given_name + ' ' + details.payer.name.surname+'/'+details.payer.payer_id+'/'+details.tansaction_id;
                console.log(details);
            });
        },
    })
    .render("#paypal-button-container");
</script>

<style>
.table td,
.table th {
    vertical-align: middle;
}
</style>
