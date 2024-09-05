<template>
    <tr class="js_this_tr" data-id="12">
        <td class="text-center">{{ roadOrder.id }}</td>
        <td>
           {{ roadOrder.name_en }}
        </td>
        <td>
            {{ roadOrder.name_ru }}
        </td>
        <td class="text-end">
            <div style="float: right;">
                <a class="btn btn-primary btn-sm js_edit_btn" data-bs-toggle="modal" data-bs-target="#customModal"
                    data-one_order_type_url=""
                    data-update_url="" title="Edit">
                    <font-awesome-icon :icon="['fas', 'pen']" />
                </a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
  props:{
    roadOrder:{
        type:Object,
        required:true
    }
  },
};
</script>
