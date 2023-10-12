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



const form = useForm({
  district: '',
  thana: '',
  village: '',
})


const thanas = ref(null);
const villages = ref(null);

watch(
  () => form.district,
  (newValue) => {
    if(newValue) {
      axios.get(`/api/thana/${newValue}`)
        .then(response => {
          thanas.value = response.data.thana;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
)


watch(
  () => form.thana,
  (newValue) => {
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
            <form @submit.prevent="console.log(form)">
              <div class="flex flex-col">
                <label for="district">District</label>
                <select v-model="form.district" name="district" id="district">
                  <option value="">Select one</option>
                  <option v-for="item in district" :key="item.id" :value="item.id">{{ item.name }}</option>
                </select>
              </div>

              <div class="mt-4 flex flex-col">
                <label for="thana">Thana</label>
                <select v-model="form.thana" name="thana" id="thana">
                  <option value="">Select one</option>
                  <option v-for="item in thanas" :key="item.id" :value="item.id">{{ item.name }}</option>
                </select>
              </div>

              <div class="mt-4 flex flex-col">
                <label for="Village">Village</label>
                <select v-model="form.village" name="Village" id="Village">
                  <option value="">Select one</option>
                  <option v-for="item in villages" :key="item.id" :value="item.id">{{ item.name }}</option>
                </select>
              </div>
              <button class="mt-4 px-4 py-2 rounded bg-gray-900 text-white" type="submit">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
  </template>
