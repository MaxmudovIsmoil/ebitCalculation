<template>
    <div class="container-fluid">
        <div class="bg-shadow">
            <div class="row mb-3">
                <div class="col-auto">
                    <button data-url="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customModal">
                        <font-awesome-icon :icon="['fas', 'plus']" /> &nbsp; {{ $t('add') }}
                    </button>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" :placeholder="$t('search')" aria-label="Search" aria-describedby="button-addon2">
                    </div>
                </div>
            </div>

            <table class="table table-sm table-bordered table-striped table-hover" id="order_type_datatable">
                <thead>
                    <tr>
                    <th class="text-center" width="3%">№</th>
                        <th>{{ $t('order_type') }} ({{ $t('english') }})</th>
                        <th>{{ $t('order_type') }} ({{ $t('russian') }})</th>
                        <th class="text-end">{{ $t('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tableRow v-for="roadOrder in roadOrders" :key="roadOrder.id" :roadOrder="roadOrder"/>
                </tbody>
            </table>
        </div>

        <createOrEditModal />
    </div>
</template>

<script>
    import tableRow from './tableRow.vue'
    import createOrEditModal from './createOrEditModal.vue'

    export default {
      name: 'roadOrderView',
      data() {
      return {
        roadOrders: [
          { id: 1, name_en: "For marketing center", nane_ru: "Для маркетинг центра" },
          { id: 2, name_en: "For new business development department", nane_ru: "Для департамента по развитию нового бизнеса" },
          { id: 3, name_en: "For IT department", nane_ru: "Для департамента по информационным технологиям" },
          { id: 4, name_en: "For united service center", nane_ru: "Для единого центра обслуживания" }
        ]
      }
    },
      components:{
        tableRow,
        createOrEditModal
      }
    }
</script>

