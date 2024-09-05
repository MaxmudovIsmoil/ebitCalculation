<template>
 <div class="container-fluid bg-shadow">
    <div class="bg-shadow m-2">
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

    <table class="table table-bordered table-striped table-sm table-hover" id="user_datatable">
        <thead>
            <tr>
                <th class="text-center" width="3%">№</th>
<!--                <th width="15%">{{ $t('order_type') }}</th>-->
                <th width="15%">{{ $t('instance') }}</th>
                <th>{{ $t('full_name') }}</th>
                <th>{{ $t('email') }}</th>
                <th>{{ $t('username') }}</th>
                <th>{{ $t('status') }}</th>
                <th>{{ $t('date') }}  {{ $t('time') }}</th>
                <th class="text-end">{{ $t('actions') }}</th>
            </tr>
        </thead>
        <tbody>
            <tableRow v-for="user in users" :key="user.id" :user="user" />
        </tbody>
    </table>
    </div>
    <createOrEditModal />
    <DeleteModal/>
</div>
</template>



<script>
import tableRow from './tableRow.vue';
import createOrEditModal from './createOrEditModal.vue';
import DeleteModal from '../../../components/DeleteModal.vue';
export default {
  name: 'Users',
  data() {
    return {
        users: [],
        userData: [],
        userId: 0,
        isLoading: true,
        showModal: false,
    };
  },
    methods: {
        authHeader() {
            const authToken = Cookies.get('auth_token');
            return {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                    'Content-Type': 'application/json',
                },
            };
        },
        async fetchUsers() {
            this.isLoading = true;
            await axios
                .get('/admin/users', this.authHeader())
                .then((res) => {
                    console.log(err);
                    this.users = res.data.data.data;
                    this.isLoading = false;
                })
                .catch((err) => {
                    console.error(err);
                    // toast.error('Произошла ошибка');
                });
        },
        // openEditModal(id) {
        //     this.showModal = true;
        //     this.userId = id;
        //     axios
        //         .get(`/admin/user/${id}`, this.authHeader())
        //         .then((res) => {
        //             this.userData = res.data.data;
        //         })
        //         .catch((err) => {
        //             console.error(err);
        //             //toast.error('Произошла ошибка');
        //         });
        // },
        // openDeleteModal(id) {
        //     this.showModal = true;
        //     this.userId = id;
        //     console.log(id);
        // },
    },
    mounted() {
        this.fetchUsers();
        setInterval(this.fetchUsers, 120000);
    },
  components:{
    tableRow, createOrEditModal, DeleteModal
  }
}
</script>
