<template>
  <form @submit.prevent="onSubmit" style="display:grid;gap:8px;max-width:520px;">
    <label>
      Card Number (20 digits)
      <input v-model="model.card_number" placeholder="12345678901234567890" />
    </label>
    <label>
      PIN (4 digits)
      <input v-model="model.pin" type="password" placeholder="1234" />
    </label>
    <label>
      Activation (YYYY-MM-DD HH:mm)
      <input v-model="model.activated_at" placeholder="2025-09-30 12:00" />
    </label>
    <label>
      Expiry (YYYY-MM-DD)
      <input v-model="model.expires_at" placeholder="2026-09-30" />
    </label>
    <label>
      Balance
      <input v-model="model.balance" placeholder="100.00" />
    </label>

    <div style="display:flex;gap:8px;">
      <button type="submit">{{ editing ? 'Update' : 'Create' }}</button>
      <button v-if="editing" type="button" @click="$emit('cancel')">Cancel</button>
    </div>

    <p v-if="error" style="color:#b00;">{{ error }}</p>
  </form>
</template>

<script setup>
import { reactive, watch, ref } from 'vue';

const props = defineProps({
  editing: { type: Boolean, default: false },
  initial: {
    type: Object,
    default: () => ({ card_number:'', pin:'', activated_at:'', expires_at:'', balance:'' })
  }
});
const emit = defineEmits(['submit','cancel']);

const model = reactive({ ...props.initial });
const error = ref('');

watch(() => props.initial, (val) => {
  Object.assign(model, val || {});
}, { deep: true });

function valid() {
  if (!/^\d{20}$/.test(model.card_number)) return 'Card number must be 20 digits';
  if (!/^\d{4}$/.test(model.pin)) return 'PIN must be 4 digits';
  if (!/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/.test(model.activated_at)) return 'Activation format invalid';
  if (!/^\d{4}-\d{2}-\d{2}$/.test(model.expires_at)) return 'Expiry format invalid';
  if (isNaN(Number(model.balance))) return 'Balance must be a number';
  return '';
}

function onSubmit() {
  const msg = valid();
  if (msg) {
    error.value = msg;
    return;
  }
  error.value = '';
  emit('submit', { ...model });
}
</script>

