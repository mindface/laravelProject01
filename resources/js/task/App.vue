<template>
  <div class="app">
    <task-container />
  </div>
</template>

<script lang="ts">
import { ref, defineComponent } from "vue";
import { Api } from "../helper/helper-api";
import TaskContainer from "./container/TaskContainer.vue";

export default defineComponent({
  components: {
    TaskContainer,
  },
  setup() {}
})
</script>
