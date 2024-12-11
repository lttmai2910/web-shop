<script setup>
import Topbar from '@/Components/Public/Topbar.vue';
import Footer from '@/Components/Public/Footer.vue';
import { ref } from 'vue';
import { useForm,  usePage } from '@inertiajs/vue3';

const {session} = usePage().props;

const form = useForm({
  name_customer: session.customer.name_customer,
  email: session.customer.email,
  phone: session.customer.phone,
  address: session.customer.address,
  gender: session.customer.gender,
  birthday: session.customer.birthday,
  image: session.customer.image,
  profile_image_url: '/image_customer/meomeo.gif'
});


const submitForm = () => {
  form.post(route('login.logout'));
};

const submitUpdate = () => {
  form.post(route('login.update', session.customer.id));
};

const handleEvent = (e) => {
    form.image = e.target.files[0];
}
</script>
<template>
    <div class="page-container">
      <Topbar />
      <div class="content-container">
        <div class="profile text-xl font-lora bg-white shadow shadow-red-900 relative">
          <img class="w-full h-52 object-cover" src="/image_customer/dautay.jpg" alt="Profile Image">
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center">
            <div class="pt-5 flex items-center justify-center">
              <div class="border-t border-white mr-2 sm:mr-0 sm:w-32"></div>
              <p class="text-sm font-bold uppercase sm:text-3xl" style="font-size: min(max(2.5vw, 14px), 4rem);">Hồ sơ của tôi</p>
              <div class="border-t border-white ml-2 sm:ml-0 sm:w-32"></div>
            </div>
            <p class="p-5 sm:text-xl">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            <div class="flex justify-center">
              <a :href="route('welcome')">
                <button type="button" class="bt-xemthem bg-red-900 border-2 border-red-900 text-white py-2 px-4 rounded">
                  Home
                </button>
              </a>
            </div>
          </div>
        </div>
        <form @submit.prevent="submitUpdate" class="font-lora mt-8">
            <div class="p-5 mx-auto my-4 max-w-screen-xl bg-white border border-red-800 shadow-lg rounded-lg flex flex-col md:flex-row justify-center">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                <p class="uppercase font-bold text-red-700 text-3xl text-center mb-8">Thông tin cá nhân</p>
                <div class="flex flex-col md:flex-row">
                <div class="flex-1">
                    <ul class="list-none">
                    <li class="pr-5 mb-4">
                        <label for="name_customer" class="font-bold text-red-800">Họ và tên:</label>
                        <input id="name_customer" v-model="form.name_customer" type="text" class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md">
                    </li>
                    <li class="pr-5 mb-4">
                        <label for="email" class="font-bold text-red-800">Email:</label>
                        <input id="email" v-model="form.email" type="email" class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md">
                    </li>
                    <li class="pr-5 mb-4">
                        <label for="phone" class="font-bold text-red-800">Số điện thoại:</label>
                        <input id="phone" v-model="form.phone" type="tel" class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md">
                    </li>
                    <li class="pr-5 mb-4">
                        <label for="address" class="font-bold text-red-800">Địa chỉ:</label>
                        <input id="address" v-model="form.address" type="text" class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md">
                    </li>
                    <li class="pr-5 mb-4">
                        <label for="gender" class="font-bold text-red-800">Giới tính:</label>
                        <select id="gender" name="gender" v-model="form.gender" class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md">
                        <option disabled value="">Chọn giới tính</option>
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                        </select>
                    </li>
                    <li class="pr-5 mb-4">
                      <label for="birthday" class="font-bold text-red-800">Ngày sinh</label>
                      <input type="date"  class="mt-1 p-2 block w-full shadow-sm focus:ring-red-500 focus:border-red-500 border-gray-300 rounded-md"
                          id="birthday" placeholder=" "
                          v-model="form.birthday">
                    </li>
                    </ul>
                </div>
                </div>
            </div>

            <div class="ml-0 md:ml-12 flex flex-col items-center justify-center">
                <label for="image" class="block font-bold text-red-800  mb-2">Hình ảnh</label>
                <input type="file" id="image" name="image" @change="handleEvent"
                class="px-2 py-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:text-black dark:placeholder-gray-400">
                <img class="mt-6 w-64 object-cover transition-all duration-300 group-hover:blur-none bg-white shadow" :src="'/image_customer/' + form.image" alt="Ảnh đại diện">
            </div>
            </div>

            <div class="flex justify-center mb-6">
            <button type="submit" class="bt-xemthem mt-3 p-5 bg-red-900 border-2 border-red-900 text-black flex justify-center rounded">
                Lưu
            </button>

            <button @click="submitForm" class="ml-20 bt-xemthem mt-3 p-5 bg-red-900 border-2 border-red-900 text-black flex justify-center rounded">
                Đăng xuất
            </button>
            </div>
        </form>
      </div>
      <Footer />
    </div>
  </template>
  
  <style scoped>
  @media (max-width: 640px) {
    .ab {
      display: none;
    }
  }
  
  .page-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  .content-container {
    flex: 1;
  }
  
  .profile {
    position: relative;
  }
  
  .bt-xemthem {
    padding: 0.5em 2em;
    font-size: 1em;
    background-color: #9a0a11;
    border: 0.1em solid #9a0a11;
    color: white;
    cursor: pointer;
    overflow: hidden;
    transition: color 0.5s, background-color 0.5s;
  }
  
  .bt-xemthem::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background-color: white;
    z-index: -1;
    transition: left 0.5s;
  }
  
  .bt-xemthem:hover::before {
    left: 0;
  }
  
  .bt-xemthem:hover {
    color: #9a0a11;
    background-color: transparent;
    transform: scaleX(1);
    transform-origin: left;
  }
  
  .doankengang {
    border-bottom: 1px solid #ccc;
    margin: 20px 0;
  }
  
  .doankedoc {
    border-left: 1px solid #ccc;
    margin: 20px 0;
  }
  </style>
  
  