<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Sidebar from '@/Components/Admin/Sidebar.vue';
import { ref, computed, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import PieChart from '@/Components/Admin/PieChart.vue'
const { props } = usePage();

const managerCount = props.managerCount;
const employeeCount = props.employeeCount;

</script>

<template>
    <Authenticated-layout>
        <Sidebar />
        <div class="bg-gray-200 p-4 sm:ml-64">
            <div class="flex items-center justify-center">
                <div class="flex flex-col overflow-hidden w-full">
                    <main class="flex-1 overflow-x-hidden overflow-y-auto">
                        <div class="w-auto font-lora">
                            <div class="h-auto p-8">
                                <p class="text-4xl uppercase">Tổng quan</p>
                                <br>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                                        <h3 class="font-semibold text-lg mb-2">Số quản lý</h3>
                                        <div class="text-3xl font-bold text-green-700">{{ managerCount }}</div>
                                    </div>
                                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                                        <h3 class="font-semibold text-lg mb-2">Số nhân viên</h3>
                                        <div class="text-3xl font-bold text-emerald-500">{{ employeeCount }}</div>
                                    </div>
                                </div>
                                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 mt-8">
                                    <h3 class="font-semibold text-lg mb-2">Biểu đồ nhân viên</h3>
                                    <PieChart :employeeCount="employeeCount" :managerCount="managerCount" />
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </Authenticated-layout>
</template>
