<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  district: {
    type: Array
  }
})



// const form = useForm({
//   selectedDistrict: '',
//   thana: '',
//   selectedThana: ''
// })


const selectedDistrict = ref(null);
const selectedThana = ref(null);

const thanas = ref(null);
const villages = ref(null);

watch(selectedDistrict, (newValue) => {
  if(newValue) {
    axios.get(`/api/thana/${newValue}`)
    .then(response => {
      thanas.value = response.data.thana;
      console.log(response.data.thana);
    })
    .catch(error => {
      console.error(error);
    });
  }

});

watch(selectedThana, (newValue) => {
  if(newValue) {
    axios.get(`/api/village/${newValue}`)
      .then(response => {
        villages.value = response.data.village;
      })
      .catch(error => {
        console.error(error);
      });
  }

});
</script>
<template>
<Head title="Dashboard" />
  <AuthenticatedLayout>
    <template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">District</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div>
            <form>
              <div class="flex flex-col">
                <label for="district">District</label>
                <select v-model="selectedDistrict" name="district" id="district">
                  <option value="">Select one</option>
                  <option v-for="item in district" :key="item.id" :value="item.id">{{ item.name }}</option>
                </select>
              </div>

              <div class="flex flex-col">
                <label for="thana">Thana</label>
                <select v-model="selectedThana" name="thana" id="thana">
                  <option value="">Select one</option>
                  <option v-for="item in thanas" :key="item.id" :value="item.id">{{ item.name }}</option>
                </select>
              </div>

              <div class="flex flex-col">
                <label for="Village">Village</label>
                <select name="Village" id="Village">
                  <option value="">Select one</option>
                  <option v-for="item in villages" :key="item.id" :value="item.id">{{ item.name }}</option>
                </select>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
  </template>
