<template>
  <form class="form" @submit="saveDog">
    <div>
      <div class="input">
        <label class="input_label" for="dog_name">Dog Name</label>
        <input
            v-model="dogToSave.name"
            class="input_field input_text"
            id="dog_name"
            name="dog_name"
            placeholder="Dog Name"
            data-testid="name"
        >
      </div>
      <div class="input">
        <label class="input_label" for="dog_breed">Dog Name</label>
        <input
            v-model="dogToSave.breed"
            class="input_field input_text"
            id="dog_breed"
            name="dog_breed"
            placeholder="Dog Breed"
            data-testid="breed"
        >
      </div>
      <div class="input">
        <input class="input_submit input_field" type="submit" value="Add dog">
      </div>
      <div :class=messageClass>
        {{ message }}
      </div>
    </div>
  </form>
</template>

<script setup>
import store from "@/stores";
import {useRouter} from "vue-router";
import {ref} from "vue";

const router = useRouter();
const dogToSave = {
    name: '',
    breed: '',
}
const message = ref('');
const messageClass= ref('success_message');
function saveDog() {
  event.preventDefault()
  store
      .dispatch('saveDog', dogToSave)
      .then((res) => {
        if(res.data.message) {
          messageClass.value = 'fail_message';
          message.value = res.data.message;
        } else {
          messageClass.value = 'success_message';
          message.value = res.data;
        }
      })
}
</script>

<style>
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
  .success_message {
    margin: auto;
    color: green;
  }
  .fail_message {
    margin: auto;
    color: red;
  }
</style>