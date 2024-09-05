<template>
      <div class="container-fluid">
        <div class="bg-shadow">
            <div class="row mb-3">
                <div class="col-auto">
                    <button data-url="https://purchase-test.etc-network.uz/admin/user" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#customModal">
                      <font-awesome-icon :icon="['fas', 'plus']" /> &nbsp; {{ $t('add') }}
                    </button>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" :placeholder="$t('search')" aria-label="Search" aria-describedby="button-addon2">
                    </div>
                </div>
            </div>
            <table class="table table-sm table-bordered table-striped table-hover" id="instance_datatable">
                <thead>
                    <tr>
                        <th class="text-center" width="3%">№</th>
                        <th>{{ $t('instance') }} ({{ $t('english') }})</th>
                        <th>{{ $t('instance') }} ({{ $t('russian') }})</th>
                        <th>{{ $t('working_hours') }}</th>
                        <th>{{ $t('date') }} {{ $t('time') }}</th>
                        <th class="text-end">{{ $t('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                  <tableRow v-for="(instance, index) in instances" :key="index" :instance="instance" :index="index + 1"/>
                </tbody>
            </table>
        </div>

        <createOrEditModal/>
        <DeleteModal/>
    </div>
</template>

<script>
    import tableRow from './tableRow.vue';
    import createOrEditModal from './createOrEditModal.vue';
    import DeleteModal from '../../../components/DeleteModal.vue';
    export default {
      name: 'InstancesView',
      data() {
        return {
          instances: [
          { id: 1, nameEn: "Regional department Fergana", nameRu: "РО Фергана", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 2, nameEn: "Regional department Andijan", nameRu: "РО Андижан", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 3, nameEn: "Regional department Namangan", nameRu: "РО Наманган", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 4, nameEn: "Regional department Termez", nameRu: "РО Термез", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 5, nameEn: "Regional department Karshi", nameRu: "РО Карши", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 6, nameEn: "Regional department Nukus", nameRu: "РО Нукус", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 7, nameEn: "Regional department Urgench", nameRu: "РО Ургенч", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 8, nameEn: "Regional department Bukhara", nameRu: "РО Бухара", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 9, nameEn: "Regional department Navoi", nameRu: "РО Навои", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 10, nameEn: "Regional department Jizzakh", nameRu: "РО Джизак", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 11, nameEn: "Regional department Samarkand", nameRu: "РО Самарканд", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 12, nameEn: "Regional department Gulistan", nameRu: "РО Гулистан", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 13, nameEn: "Contracts department (execution)", nameRu: "Отдел контрактов (исполнение)", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 14, nameEn: "General director", nameRu: "Генеральный директор", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 15, nameEn: "Secretary", nameRu: "Секретарь", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 16, nameEn: "New business development department", nameRu: "Департамент по развитию нового бизнеса", workingHour: 8, dateTime: "26.01.2023 17:36" },
          { id: 17, nameEn: "Marketing director", nameRu: "Директор департамента по Маркетингу", workingHour: 8, dateTime: "26.01.2023 17:36" }
        ]
        }
      },
      components:{
        tableRow,
        createOrEditModal,
        DeleteModal
      }
    }
</script>
