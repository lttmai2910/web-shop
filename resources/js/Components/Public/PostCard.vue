<script setup>
import { defineProps } from 'vue';

defineProps({
  post: Object,
});

function formatDate(dateTime) {
  const date = new Date(dateTime);
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}
</script>

<template>
  <div class="postcard" v-if="post && post.id">
    <a :href="route('postitem', { id: post.id })" class="block">
      <img :src="`/image_post/${post.image}`" alt="Post Image" class="post-image object-cover" />
      <div class="mt-2 mx-6">
        <h2 class="text-lg font-semibold text-gray-800 flex justify-center">{{ post.title }}</h2>
        <p class="text-sm text-gray-600 line-clamp-3">{{ post.body }}</p>
      </div>
      <div class="flex justify-end items-center mt-2 mx-2">
        <p class="text-sm text-gray-600">By: {{ post.user.name }}</p>
        <span class="mx-1 text-gray-600">•</span>
        <p class="text-sm text-gray-600">{{ formatDate(post.created_at) }}</p>
      </div>
    </a>
  </div>

  </template>
  
  <style scoped>
  .postcard {
    border: 0.1cqi solid #e2e8f0;
    border-radius: 0.5rem;
    overflow: hidden;
    transition: transform 0.2s ease-in-out;
  }
  
  .postcard:hover {
    transform: translateY(-2px);
  }
  
  .post-image {
    width: 100%;
    height: 20cqi;
  }
  
  .line-clamp-3 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-line-clamp: 3;
  }
  </style>
  
