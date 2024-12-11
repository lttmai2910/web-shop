<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import { ref } from 'vue';

    defineProps({
        productcolor: Object, 
    });
    
    const form=useForm({
        
    });

    const showDialog = ref(false);
    const successMessage = ref('');

    function destroy(id) {
    console.log('Hàm destroy được gọi với id:', id); // Thông báo kiểm tra
    if (confirm("Bạn có chắc là muốn xóa nó chứ !!!")) {
            form.delete(route('productcolor.destroy', id),
        {
            onSuccess: () => {
                successMessage.value = 'Xóa màu thành công !';
                showDialog.value = true;
            }
        });
    }
    }
    
    function create(){
        form.get(route('productcolor.create'));
    }

</script>

<template>
    <AuthenticatedLayout>
    <Sidebar/>
    <div class="bg-gray-200 p-4 sm:ml-64">
      <div class="flex items-center justify-center">
            <div class="flex flex-col overflow-hidden">
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                        <div class="relative flex flex-col md:flex-row w-auto font-lora">
                            <div class="h-auto p-8">
                            <p class="text-4xl uppercase">Bảng màu</p>
                            <br>
                        <div class="flex justify-between items-center">
                            <button @click="create()" class="inline-flex items-center px-4 py-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                Thêm màu
                            </button>
                        </div>
                        <br>
                        <div class="relative overflow-x-auto rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="text-xs text-white uppercase bg-emerald-700 dark:bg-emerald-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 sm:px-1 text-center w-96">Mã màu</th>
                                        <th scope="col" class="px-6 py-3 sm:px-1 text-center w-96">Tên màu</th>
                                        <th scope="col" class="px-6 py-3 sm:px-1 text-center w-96">Chức năng</th>
                                    </tr> 
                                </thead>
                                <tbody v-if='productcolor && productcolor.data.length > 0'>
                                    <tr v-for='(productcol, index) in productcolor.data' :key="index" class="bg-slate-50 border-b border-gray-300 hover:bg-gray-100 cursor-pointer">
                                        <td class="py-4 px-4 sm:px-3 text-center">{{ productcol.id }}</td>
                                        <td class="py-4 px-4 sm:px-3 text-center">{{ productcol.color_name }}</td>
                                        <td class="flex flex-row justify-center sm:py-16 py-6 px-4 sm:px-6 text-center">
                                            <a @click="destroy(productcol.id)" class="flex items-center justify-center w-8 h-8">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-emerald-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </a>
                                            <a :href="route('productcolor.edit', productcol.id)" class="flex items-center justify-center w-8 h-8">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-emerald-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </a>
                                        </td>                                                        
                                    </tr>
                                </tbody>
                            </table>       
                        </div>
                            <div class="flex justify-center">
                                <Pagination :links="productcolor.links" colorScheme="admin"/>
                            </div>  
                        </div>
                    </div>
                </main>
                </div>
            </div>
        </div>
        <!-- Success Dialog Modal -->
        <dialog v-if="showDialog" class="fixed inset-0 z-50 flex items-center justify-center font-lora">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <div class="flex justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="h-16 w-16 text-emerald-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15L15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-center">{{ successMessage }}</p>
                    <div class="mt-4 flex justify-center">
                        <button @click="showDialog = false" class="inline-flex items-center px-8 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </dialog>
    </AuthenticatedLayout>
</template>
