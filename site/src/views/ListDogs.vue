<template>
  <div>
    <form class="form" @submit="getAllDogs">
      <div>
        <div class="input">
          <label class="input_label" for="dog_name">Dog Name</label>
          <input class="input_field input_text" id="dog_name" name="dog_name" v-model="dog.name" placeholder="Dog Name">
        </div>
        <div class="input">
          <input class="input_submit input_field" type="submit" value="Get all dogs">
        </div>
      </div>
    </form>
    <div>
      <VRow>
        <VCol>
          Id
        </VCol>
        <VCol>
          Name
        </VCol>
        <VCol>
          Data
        </VCol>
      </VRow>
      <VCol v-for="dog in dogs">
        <VRow>
          <VCol>
            {{ dog.id }}
          </VCol>
          <VCol>
            {{ dog.data.name }}
          </VCol>
          <VCol>
            {{ dog.data }}
          </VCol>
        </VRow>
      </VCol>
    </div>
  </div>
</template>

<style>
  .form {
    min-height: 40vh;
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
</style>
<script setup>
import store from "@/stores";
import {useRouter} from "vue-router";
import { ref, watch } from 'vue'

const router = useRouter();
const dog = {
  name: '',
};
const dogs = ref([]);

function getAllDogs() {
  event.preventDefault()
  if(dog.name === '') {
    store
        .dispatch('getAllDogs')
        .then((res) => {
          dogs.value = res;
        })
  } else {
    store
        .dispatch('getAllNamedDogs', dog.name)
        .then((res) => {
          dogs.value = res;
        })
  }

}
</script>