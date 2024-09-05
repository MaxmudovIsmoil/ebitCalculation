<template>
    <tr class="js_this_tr" data-id="{{ instance.id }}">
        <td class="text-center">{{ index }}</td>
        <td>
            {{ instance.nameEn }}
        </td>
        <td>
            {{ instance.nameRu }}
        </td>
        <td>{{ instance.workingHour }}</td>
        <td>{{ instance.dateTime }}</td>
        <td class="text-end">
            <div class="d-flex" style="float: right;">
                <a class="btn btn-primary btn-sm me-2 js_edit_btn" data-bs-toggle="modal" data-bs-target="#customModal"
                    data-one_instance_url=""
                    data-update_url="" title="Edit">
                    <font-awesome-icon :icon="['fas', 'pen']"/>
                </a>
                <a class="btn btn-danger btn-sm js_delete_btn" data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    data-url="" title="Delete">
                    <font-awesome-icon :icon="['fas', 'trash-alt']" />
                </a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
  props: {
    instance:{
        type:Object,
        required:true
    }
  },
};
</script>
