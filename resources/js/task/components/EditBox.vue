<template>
  <div class="edit-box">
    <button @click="switcherAction">{{ switcher ? "close" : "view" }}</button>
    <transition>
      <div class="viewer" v-if="switcher">
        <p><input type="text" v-model="title">{{ title }}</p>
        <p><textarea type="text" v-model="body"></textarea>{{ body }}</p>
        <p><input type="submit" value="update" @click="editAction()"></p>
        <p><input type="submit" value="delete" @click="deleteAction()"></p>
      </div>
    </transition>
  </div>
</template>

<script lang="ts">
import { ref, defineComponent, PropType } from "vue";
import { Api } from "../../helper/helper-api";

import { Task } from "../model/task";

type Props = {
  task: Task;
}

export default defineComponent({
  props: {
    task: {
      type: Object as PropType<Task>,
      default: "",
    }
  },
  setup(props: Props, { emit }) {
    const switcher = ref(false);
    const task = ref(props.task);
    const title = ref(props.task.title);
    const body = ref(props.task.body);

    const editAction = async () => {
      if(title.value === "" || body.value === "") {
        return alert("タイトルと詳細を入力してください。");
      }
      const data = await Api.updateTaskApi(task.value,title.value, body.value);
      emit("loadListAction");
    }

    const deleteAction = async () => {
      const data = await Api.deleteTaskApi(task.value);
      emit("loadListAction");
    }

    const switcherAction = () => {
      switcher.value = !switcher.value;
    }

    return {
      switcher,
      title,
      body,
      editAction,
      deleteAction,
      switcherAction
    }
  }
});
</script>
<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
.edit-box {
  position: relative;
}
.viewer {
  position: absolute;
  top: 100%;
  z-index: 1;
  padding: 10px;
  background-color: #fff;
  box-shadow: 0 2px 10px 0 #ccc;
}

</style>