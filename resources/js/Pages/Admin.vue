<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from '../Components/Admin/Sidebar.vue';
import { ref } from 'vue';
import ContentAdmin from '@/Layouts/ContentAdmin.vue';


</script>

<template>
  <div class="">
    <AuthenticatedLayout/>
        <Sidebar/>
  </div>
</template>





