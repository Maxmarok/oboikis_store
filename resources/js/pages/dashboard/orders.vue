<script setup>
import { onMounted, ref } from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"

const orders = ref([])

onMounted(() => {
    getOrders()
});

const getOrders = () => {
    axios.get('/api/v1/dashboard/orders')
    .then(res => {
      orders.value = res.data.data
    })
}
</script>
<template>
<PageHeader :title="title" :items="items" />
<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-sticky mb-0 text-nowrap text-center">
          <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Заказ</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders"> 
                <td v-html="order.id" />
                <td v-html="order.name" />
                <td v-html="order.user.email" />
                <td v-html="order.phone" />
                <td v-html="order.order_items" />
            </tr>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
</template>