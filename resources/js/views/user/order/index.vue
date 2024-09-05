<template>
  <div class="container-fluid">
    <div class="bg-shadow">
      <div class="d-flex align-items-center">
        <div>
          <a class="btn btn-primary js_add_btn mb-3" data-bs-toggle="modal" data-bs-target="#addOrderModal">
            <font-awesome-icon :icon="['fas', 'plus']" /> {{ $t('add') }}
          </a>
        </div>
        <div class="ms-3">
          <div class="form-check form-switch">
            <input class="form-check-input js_hide_show_tr_btn" @change="showActual"
              data-status="1" type="checkbox" role="switch" id="actuallyOrders">
            <label class="form-check-label" for="actuallyOrders">{{ $t('actual') }}</label>
          </div>
        </div>
      </div>
      <table id="order_datatable" class="table table-bordered table-fs-sm table-striped table-responsive" style="width:100%;">
        <thead>
          <tr>
            <th>№</th>
            <th>{{ $t('created') }}</th>
            <th>{{ $t('customer_address') }}</th>
            <th>{{ $t('secondary_recipients') }}</th>
            <th>{{ $t('type') }}</th>
            <th>{{ $t('status') }}</th>
            <th>{{ $t('current_instance') }}</th>
            <th>{{ $t('stage') }}</th>
            <th>{{ $t('deadline') }}</th>
            <th>{{ $t('comment') }}</th>
          </tr>
        </thead>
        <tbody>
          <tableRow v-for="(item, index) in paginatedItems" :key="index" :order="item" :index="index + 1" />
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        <Pagination
          :totalItems="showOrders.length"
          :itemsPerPage="itemsPerPage"
          v-model:currentPage="currentPage"
        />
      </div>
    </div>
    <createModal/>

  </div>
</template>

<script>
import tableRow from './tableRow.vue';
import createModal from './createModal.vue';
import Pagination from '../../../components/Pagination.vue';
import data from '../../../fake-data/orders.json';

export default {
  name: 'Orders',
  components: {
    tableRow,
    createModal,
    Pagination
  },
  data() {
    return {
      currentPage: 1,
      itemsPerPage: 6,
      orders: [],
      showOrders: []
    };
  },
  created() {
    this.orders = data.orders;
    this.showOrders = this.orders;
  },
  computed: {
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.showOrders.slice(start, end);
    }
  },
  methods: {
    showActual(event) {
      const isChecked = event.target.checked;
      if (isChecked) {
        this.showOrders = this.orders.filter(order => {
          return order.status === "Тест 1" || order.status === "Тест 2";
        });
      } else {
        this.showOrders = this.orders;
      }
      this.currentPage = 1;
    }
  }
};
</script>
