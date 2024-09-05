<template>
        <tr class="js_this_tr" data-id="1">
                <td align="center">{{ instanceChild.stage }}</td>
                <td>{{ instanceChild.instance }}</td>
                <td>{{ instanceChild.users }}</td>
                <td align="center">
                    <div class="d-flex">
                        <button class="btn btn-primary btn-sm me-2 js_edit_btn"  data-bs-toggle="modal" data-bs-target="#customModal"
                            data-one_diu_url="https://purchase-test.etc-network.uz/admin/user-instance/one/1"
                            data-update_url="https://purchase-test.etc-network.uz/admin/user-instance/1"
                            data-order_type_name=" For technical department "
                            data-order_type_id="1" title="Edit">
                            <font-awesome-icon :icon="['fas', 'pen']" />
                        </button>
                        <button class="btn btn-danger btn-sm js_delete_btn" href="javascript:void(0);" @click="showModal"
                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                            data-url="https://purchase-test.etc-network.uz/admin/user-instance/1"
                            title="Delete">
                            <font-awesome-icon :icon="['fas', 'trash-alt']" />
                        </button>
                    </div>
                </td>
        </tr>
</template>
<script>
export default {
 props:{
    instanceChild:{
        type:Object,
        required:true
    }
 }
};
</script>

