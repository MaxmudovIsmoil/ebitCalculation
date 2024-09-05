<template>
    <div class="container-fluid">
        <div class="row">
            <gridCard v-for="(instance,index ) in instances"  :key="index" :instance="instance"/>

             <createOrEditModal />
             <DeleteModal/>
        </div>
        </div>
</template>

<script>
    import DeleteModal from '../../../components/DeleteModal.vue';
    import gridCard from './gridCard.vue'
    import createOrEditModal from './createOrEditModal.vue'

    export default {
      name: 'InstanceUsers',
      components:{
        gridCard,
        createOrEditModal,
        DeleteModal
      },
      data() {
        return {
        instances: [
            [
                { stage: 1, instance: "Technical department", users: "Saibnazarov Sanjar, Abduvokhidova Shokhsanambonu, Khodjageldiev Khudayberdi Kuldashovich, Almatov Naimbek Valibekovich, Baymukhamedov Akbar, Магдиев Аваз, Nam Aleksey" },
                { stage: 1, instance: "Technical director", users: "Husniddin Tuychiev" },
                { stage: 1, instance: "Contracts department", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 1, instance: "Financial director", users: "Kim Sungmin, Lee Baek Hee" },
                { stage: 1, instance: "General director", users: "Lee Baek Hee" },
                { stage: 1, instance: "Secretary", users: "Khurshida Chemketova" }
            ],
            [
                { stage: 1, instance: "Contracts department (execution)", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 2, instance: "Commercial department", users: "" },
                { stage: 2, instance: "Contracts department", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 2, instance: "Corporate strategy department", users: "Nodir Xalliev" },
                { stage: 2, instance: "Financial director", users: "Kim Sungmin, Lee Baek Hee" },
                { stage: 2, instance: "General director", users: "Lee Baek Hee" },
                { stage: 2, instance: "Secretary", users: "Khurshida Chemketova" }
            ],
            [
                { stage: 2, instance: "Contracts department (execution)", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 3, instance: "Corporate strategy department", users: "Nodir Xalliev" },
                { stage: 3, instance: "Contracts department", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 3, instance: "Financial director", users: "Kim Sungmin, Lee Baek Hee" },
                { stage: 3, instance: "General director", users: "Lee Baek Hee" },
                { stage: 3, instance: "Secretary", users: "Khurshida Chemketova" }
            ],
            [
                { stage: 3, instance: "Contracts department (execution)", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 4, instance: "United service center", users: "" },
                { stage: 4, instance: "Contracts department", users: "Sarvar Atadjanov, Javokhir Siddikov" },
                { stage: 4, instance: "Corporate strategy department", users: "Nodir Xalliev" },
                { stage: 4, instance: "Financial director", users: "Kim Sungmin, Lee Baek Hee" },
                { stage: 4, instance: "General director", users: "Lee Baek Hee" },
                { stage: 4, instance: "Secretary", users: "Khurshida Chemketova" },
                { stage: 4, instance: "Contracts department (execution)", users: "Sarvar Atadjanov, Javokhir Siddikov" }
            ]
        ]
      }
      },
      methods: {
        generateRandomNumber() {
          return Math.floor(Math.random() * 6) + 5;
        },
      },
    }
</script>
