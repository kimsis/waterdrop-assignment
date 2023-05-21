<template>
  <form class="form" @submit="saveDog">
    <div>
      <div class="input">
        <label class="input_label" for="dog_name">Dog Name</label>
        <input class="input_field input_text" id="dog_name" name="dog_name" v-model="dogToSave.name" placeholder="Dog Name">
      </div>
      <div class="input">
        <label class="input_label" for="dog_breed">Dog Name</label>
        <input class="input_field input_text" id="dog_breed" name="dog_breed" v-model="dogToSave.breed" placeholder="Dog Breed">
      </div>
      <div class="input">
        <input class="input_submit input_field" type="submit" value="Add dog">
      </div>
    </div>
  </form>
</template>

<style>
@media (min-width: 1024px) {
  .form {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
  .input {
    margin: 16px;
  }
  .input_label {
    margin-right: 8px;
    color: #AAAAAA;
  }
  .input_field {
    border-radius: 4px;
    border-width: 0;
  }
  .input_text {
    height: 30px;
    color: #333333;
  }
  .input_submit {
    background-color: #333333;
    color: #FFFFFF;
    cursor: pointer;
    display: flex;
    font-weight: 500;
    margin: auto;
    padding: 10px 12px;
    text-align: center;
  }
}
</style>
<script setup>
import store from "@/stores";
import {useRouter} from "vue-router";

const router = useRouter();
const dogToSave = {
  name: '',
  breed: '',
}
function saveDog() {
  event.preventDefault()
  console.log(dogToSave)
  store
      .dispatch('saveDog', dogToSave)
      .then((res) => {
        console.log(res);
      })
}
</script>