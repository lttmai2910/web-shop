<script setup>
import Welcome from '../../Pages/Welcome.vue'; // Sử dụng đường dẫn tương đối
</script>

<template>
    <!-- Footer -->
    <footer class="footer text-white font-lora" :style="{ backgroundColor: '#9a0a11' }">
        <div class="bg-gray-200 flex justify-center items-center mb-6 py-4">
            <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black">
                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
            </svg>
            <p class="text-black ml-2">Hỗ trợ / Mua hàng: <a href="#" style="color:crimson">09333695144</a></p>
        </div>
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="flex flex-col md:flex-row md:justify-between">
            <div class="mb-6 md:mb-0 font-script">
                <a href="#" class="flex items-center">
                    <img src="../../../../public/Image_logo/logodaustorevientrang.svg" class="h-8 me-3" alt="LogoDauStore" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Dâu Store</span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3 justify-items-center">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Thông tin liên hệ</h2>
                    <ul class="text-white dark:text-white font-medium">
                        <li class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                                <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                            </svg>
                            <p>11 Thảo Điền, Quận 1, TP.HCM</p>
                        </li>
                        <li class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                            </svg>
                            <p>0933695144</p>
                        </li>
                        <li class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>
                            <p>daustore@gmail.com</p>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Mạng xã hội</h2>
                    <ul class="text-white dark:text-white font-medium">
                        <div class="grid grid-cols-1 gap-2 mt-4 sm:justify-center sm:mt-0">
                            <li class="">
                                <a href="#" class="link mb-2 text-white">
                                    <span class="flex items-center group">
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                                        </svg>
                                        <p>Facebook</p>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="link mb-2 text-white">
                                    <span class="flex items-center group">
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                                        </svg>
                                        <p>Instagram</p>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="link mb-2 text-white">
                                    <span class="flex items-center group">
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                                        </svg>
                                        <p>X</p>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="link mb-2 text-white">
                                    <span class="flex items-center group">
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.942 5.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.586 11.586 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3 17.392 17.392 0 0 0-2.868 11.662 15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.638 10.638 0 0 1-1.706-.83c.143-.106.283-.217.418-.331a11.664 11.664 0 0 0 10.118 0c.137.114.277.225.418.331-.544.328-1.116.606-1.71.832a12.58 12.58 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM8.678 14.813a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.929 1.929 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/>
                                        </svg>
                                        <p>Youtube</p>
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Chính sách</h2>
                    <ul class="text-white dark:text-white font-medium">
                        <li class="mb-4">
                            <a href="#" class="link">Chính sách bảo mật</a>
                        </li>
                        <li>
                            <a href="#" class="link">Các điều khoản & điều kiện</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-white sm:mx-auto dark:border-white lg:my-8" />
        <div class="flex items-center justify-center sm:flex sm:items-center">
            <span class="text-sm text-white sm:text-center">
                © 2024 
                <a href="#" class="">DâuStore™</a>. All Rights Reserved. 
            </span>
        </div>
    </div>
</footer>

</template>
<style scoped>
.footer {
    position: relative;
    margin-top: auto;
    clear: both;
}
</style>




