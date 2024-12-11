<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login.check'))
};
</script>

<template>
  <section class="h-screen flex items-center justify-center bg-gray-100 font-lora">
    <div class="container h-full px-6 py-24">
      <div class="flex h-full flex-wrap items-center justify-center lg:justify-between">
        <!-- Left column container with background -->
        <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
          <img
            src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="w-full"
            alt="Phone image"
          />
        </div>

        <!-- Right column container with form -->
        <div class="md:w-8/12 lg:ms-6 lg:w-5/12 bg-white p-8 rounded-lg shadow-lg">
          <h2 class="text-2xl font-semibold mb-6 text-center uppercase">Đăng nhập</h2>
          <form @submit.prevent="submit">
            <!-- Email input -->
            <div class="relative mb-6">
              <input
                type="email"
                class="input-field focus:ring-red-500"
                id="email"
                placeholder=" "
                v-model="form.email"
                required
              />
              <label
                for="email"
                class="input-label"
              >Email</label>
              <p v-if="emailError" class="error-message">{{ emailError }}</p>
            </div>

            <!-- Password input -->
            <div class="relative mb-6">
              <input
                type="password"
                class="input-field focus:ring-red-500"
                id="password"
                placeholder=" "
                v-model="form.password"
                required
              />
              <label
                for="password"
                class="input-label"
              >Mật khẩu</label>
              <p v-if="passwordError" class="error-message">{{ passwordError }}</p>
            </div>

            <!-- Submit button -->
            <button
              type="submit"
              class="bt-xemthem w-full"
            >
              Đăng nhập
            </button>

            <!-- Divider -->
            <div
              class="my-4 flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-neutral-300 after:mt-0.5 after:flex-1 after:border-t after:border-neutral-300">
              <p
                class="mx-4 mb-0 text-center font-semibold text-neutral-300">
                HOẶC
              </p>
            </div>

            <!-- Social login buttons -->
            <!-- <div>
              <a          
              @click="loginWithGoogle"
              class="mb-3 flex w-full items-center justify-center rounded bg-red-500 px-7 pb-2.5 pt-3 text-center text-sm font-medium leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-red-600 focus:bg-red-600 focus:outline-none focus:ring-0 active:bg-red-700"
              href="#!"
              role="button">
              <span class="mr-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z" clip-rule="evenodd"/>
                  </svg>
              </span>
              Đăng nhập với Google
            </a>
            </div> -->

            <!-- Register link -->
            <div class="text-center">
              <a
                :href="route('register.index')"
                class="register-link text-gray-400 flex items-center justify-center space-x-2 transition duration-150 ease-in-out"
                @click="register"
              >
                <span>Tạo tài khoản</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.input-field {
  width: 100%;
  min-height: auto;
  padding: 1rem 1.5rem;
  border-radius: 0.5rem;
  border: 1px solid #E5E7EB;
  transition: border-color 0.3s ease;
}

.input-field:focus {
  outline: none;
  border-color: #DC2626;
}

.input-label {
  position: absolute;
  left: 1.5rem;
  top: 1rem;
  margin-bottom: 0;
  max-width: calc(100% - 3rem);
  transform-origin: 0 0;
  pointer-events: none;
  font-size: 0.875rem;
  color: #9CA3AF;
  transition: transform 0.3s ease, color 0.3s ease;
}

.input-field:focus + .input-label,
.input-field:not(:placeholder-shown) + .input-label {
  transform: translateY(-170%) scale(0.85);
  color: #DC2626;
}


.error-message {
  color: #EF4444;
  font-size: 0.75rem;
  margin-top: 0.25rem;
}

.bt-xemthem-container {
    display: flex;
    justify-content: center;
}

.bt-xemthem {
    padding: 0.5em 2em; /* Thiết lập padding cho nút */
    font-size: 1em; /* Thiết lập kích thước font */
    background-color: #9a0a11; /* Màu nền đỏ */
    border: 0.1em solid #9a0a11; /* Border màu đỏ */
    color: white; /* Màu chữ trắng */
    cursor: pointer;
    overflow: hidden;
    transition: color 0.5s, background-color 0.5s; /* Thêm transition cho màu và nền */
}

.bt-xemthem::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%; /* Bắt đầu với vị trí bên trái ngoài màn hình */
    width: 100%; /* Kích thước mặc định của pseudo-element */
    height: 100%;
    background-color: white; /* Màu nền trắng */
    z-index: -1;
    transition: left 0.5s; /* Thêm transition cho left */
}

.bt-xemthem:hover::before {
    left: 0; /* Khi hover, dịch chuyển pseudo-element từ trái vào trong */
}

.bt-xemthem:hover {
    color: #9a0a11; /* Khi hover, chữ chuyển sang màu đỏ */
    background-color: transparent; /* Khi hover, chuyển từ đỏ sang trong suốt */
    transform: scaleX(1); /* Bắt đầu với chiều rộng 0 */
    transform-origin: left; 
}

.social-button {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.3s ease;
}

.social-button svg {
    width: 24px;
    height: 24px;
}

.register-link {
    transition: color 0.3s ease; /* Thêm transition cho màu chữ */
}

.register-link:hover {
    color: #9a0a11; /* Màu chữ khi hover */
}

.register-link svg {
    transition: transform 0.3s ease; /* Thêm transition cho transform */
}

.register-link:hover svg {
    transform: translateX(5px); /* Dịch chuyển svg sang phải khi hover */
}

a.text-red-600:hover {
    text-decoration: underline;
}
</style>

