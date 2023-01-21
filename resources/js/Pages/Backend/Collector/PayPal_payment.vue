<template>
    <main id="main" class="main">
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <input
                        type="hidden"
                        id="collection_id"
                        :value="collection_id"
                    />
                    <input type="hidden" id="amount" :value="amount" />
                    <input type="hidden" id="company" :value="company" />
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
    props: ["collection_id", "amount", "company"],
    created() {},
    data() {
        return {};
    },

    methods: {},
};
paypal
    .Buttons({
        createOrder: function (data, actions) {
            var amounts = document.getElementById("amount").value;
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
            // console.log(data);
            return actions.order.capture().then(function (details) {
                var amounts = document.getElementById("amount").value;
                var company = document.getElementById("company").value;
                var collection_id =
                    document.getElementById("collection_id").value;

                // window.location.href='/save_order/'+amounts+'/'+company+'/'+details.status+'/'+details.payer.email_address+'/'+details.payer.name.given_name + ' ' + details.payer.name.surname+'/'+details.payer.payer_id+'/'+details.tansaction_id;

                window.location.href =
                    "/save_order_from_email/" +
                    amounts +
                    "/" +
                    company +
                    "/" +
                    collection_id +
                    "/" +
                    details.status +
                    "/" +
                    details.payer.email_address +
                    "/" +
                    details.payer.name.given_name +
                    " " +
                    details.payer.name.surname +
                    "/" +
                    details.payer.payer_id +
                    "/" +
                    details.tansaction_id;
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
