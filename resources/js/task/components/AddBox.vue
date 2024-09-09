<template>
  <div class="add-box">
    <p>追加 box</p>
    <p><input type="text" v-model="title">{{ title }}</p>
    <p><textarea type="text" v-model="body"></textarea>{{ body }}</p>
    <p><input type="submit" value="go" @click="addAction()"></p>
  </div>
</template>

<script lang="ts">
import { ref, defineComponent } from "vue";
import { Api } from "../../helper/helper-api";

export default defineComponent({
  setup(_, { emit }) {
    const title = ref("");
    const body = ref("");

    const addAction = async () => {
      if(title.value === "" || body.value === "") {
        return alert("タイトルと詳細を入力してください。");
      }
      const data = await Api.addTaskApi(title.value, body.value);
      emit("loadListAction");
    }

    return {
      title,
      body,
      addAction
    }
  }
});
</script>

<style>
.add-box {
  padding: 10px;
}
</style>
