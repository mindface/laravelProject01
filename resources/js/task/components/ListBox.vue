<template>
  <div class="container">
    <div class="list-box">
      <transition-group>
        <div class="item" v-for="item in list" :key="item.id">
          <p>{{ item.title }}</p>
          <edit-box :task="item" @loadListAction="onLoad" />
        </div>
      </transition-group>
    </div>
  </div>
</template>

<script lang="ts">
import { onMounted, ref, defineComponent } from "vue";
import { Api } from "../../helper/helper-api";
import type { Task } from "../model/task";
import EditBox from "./EditBox.vue";

export default defineComponent({
  components: {
    EditBox
  },
  setup() {
    const list = ref<Task[]>([]);

    const onLoad = async () => {
      const data = await Api.getTaskApi();
      list.value = data;
    }

    onMounted( async () => {
      onLoad();
    });

    return {
      list,
      onLoad
    }
  }
});
</script>

<style>
.list-box {
  padding: 10px;
}

.v-enter-active, .v-leave-active {
  transition: all 500ms;
}
.v-enter, .v-leave-to {
  opacity: 0;
}
.v-leave-active {
  position: absolute;
}
</style>
