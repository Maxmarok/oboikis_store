<script setup>
import { onMounted, ref } from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"

const title = 'Список заказов'
const orders = ref(null)

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
<PageHeader :title="title" />
<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
  <div class="col-12">
    <div class="card" v-if="orders && orders.length > 0">
      <div class="table-responsive">
        <table class="table table-sticky mb-0 text-nowrap">
          <thead class="thead-light">
            <tr>
                <th>Номер заказа</th>
                <th>Получатель</th>
                <th>Заказ</th>
                <th>Статус</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders"> 
                <td>
                  <p v-html="order.id" />
                </td>

                <td>
                  <p>
                    <strong v-html="'Имя: '" />
                    <span v-html="order.name" />
                  </p>

                  <p>
                    <strong v-html="'Emai: '" />
                    <span v-html="order.user.email" />
                  </p>

                  <p>
                    <strong v-html="'Телефон: '" />
                    <span v-html="order.phone" />
                  </p>
                </td>

                <td>
                  <p v-for="order_item, i in order.order_items">
                    <span>{{i + 1}}. <a :href="order_item.item.link" target="_blank">{{order_item.item.title}}</a> {{order_item.quantity}} шт. x {{order_item.total.toLocaleString('ru')}} ₽</span>
                  </p>
                  <p>Итого: {{ order.order_sum.toLocaleString('ru') }}₽</p>
                </td>

                <td>
                  <button class="btn btn-main">Подтвердить заказ</button>
                </td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>

    <div v-if="orders && orders.length === 0" >
      <p>Заказов нет</p>
    </div>

    <div v-if="!orders">
      <p>Идет загрузка заказов..</p>
    </div>
  </div>
</div>
</template>