<template>
    <div class="col-md-6 mb-4">
        <div class="bg-shadow">
            <div class="width-100 mb-4">
                <b>{{$t('order_type')}}:  for technical department </b>
                <button class="btn btn-primary float-end js_add_btn"
                    data-order_type_id="1"
                    data-order_type_name=" For technical department "
                    data-url="https://purchase-test.etc-network.uz/admin/user-instance"
                    data-bs-toggle="modal" data-bs-target="#customModal"> <font-awesome-icon :icon="['fas', 'plus']" />  {{ $t('add') }}</button>
            </div>

            <table class="table table-striped table-sm table-hover table-responsive" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">{{ $t('stage') }}</th>
                        <th>{{ $t('instance') }}</th>
                        <th>{{ $t('instance_users') }}</th>
                        <th>{{ $t('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tableRow v-for="(instanceChild, index) in instance"  :key="index" :instanceChild="instanceChild" />
                </tbody>
            </table>

        </div>
    </div>
</template>
<script>
import tableRow from './tableRow.vue';
export default {
  props: {
    instance: {
      type: Array,
      required: true,
    },
  },
  components: {
    tableRow,
  }
};
</script>

