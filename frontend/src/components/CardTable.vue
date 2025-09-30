<template>
  <table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse; width: 100%; max-width: 960px;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Card Number</th>
        <th>PIN</th>
        <th>Activated</th>
        <th>Expiry</th>
        <th>Balance</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody v-if="rows && rows.length">
      <tr v-for="r in rows" :key="r.id">
        <td>{{ r.id }}</td>
        <td>{{ r.card_number }}</td>
        <td>{{ r.pin }}</td>
        <td>{{ r.activated_at }}</td>
        <td>{{ r.expires_at }}</td>
        <td>{{ r.balance }}</td>
        <td>
          <button @click="$emit('edit', r)">Edit</button>
          <button @click="$emit('remove', r.id)">Delete</button>
        </td>
      </tr>
    </tbody>
    <tbody v-else>
      <tr><td colspan="7" style="text-align:center;color:#666;">No data</td></tr>
    </tbody>
  </table>
  <p v-if="loading" style="color:#666;">Loading...</p>
</template>

<script setup>
defineProps({
  rows: { type: Array, default: () => [] },
  loading: { type: Boolean, default: false }
});
defineEmits(['edit','remove']);
</script>
