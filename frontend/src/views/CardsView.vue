<template>
  <section>
    <card-form
      :editing="editing"
      :initial="formInitial"
      @cancel="cancelEdit"
      @submit="handleSubmit"
    ></card-form>

    <hr />

    <card-table
      :rows="rows"
      :loading="loading"
      @edit="startEdit"
      @remove="removeCard"
    ></card-table>

    <div style="margin-top:12px;display:flex;gap:8px;align-items:center;">
      <button :disabled="page<=1 || loading" @click="load(page-1)">Prev</button>
      <span>Page {{ page }} / {{ lastPage }}</span>
      <button :disabled="page>=lastPage || loading" @click="load(page+1)">Next</button>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { getCards, createCard, updateCard, deleteCard } from '../services/api';
import CardForm from '../components/CardForm.vue';
import CardTable from '../components/CardTable.vue';

const rows = ref([]);
const page = ref(1);
const lastPage = ref(1);
const loading = ref(false);

const editing = ref(false);
const editingId = ref(null);
const formInitial = ref({
  card_number: '',
  pin: '',
  activated_at: '',
  expires_at: '',
  balance: ''
});

async function load(p = 1) {
  loading.value = true;
  try {
    const { data } = await getCards(p);
    rows.value = data.data;
    page.value = data.meta.current_page;
    lastPage.value = data.meta.last_page;
  } catch (e) {
    alert('Failed to load cards');
  } finally {
    loading.value = false;
  }
}

function startEdit(row) {
  editing.value = true;
  editingId.value = row.id;
  formInitial.value = {
    card_number: row.card_number,
    pin: row.pin,
    activated_at: (row.activated_at || '').slice(0, 16).replace('T', ' '),
    expires_at: row.expires_at || '',
    balance: String(row.balance ?? '')
  };
}

function cancelEdit() {
  editing.value = false;
  editingId.value = null;
  formInitial.value = { card_number:'', pin:'', activated_at:'', expires_at:'', balance:'' };
}

async function handleSubmit(payload) {
  try {
    if (editing.value && editingId.value) {
      await updateCard(editingId.value, payload);
      cancelEdit();
    } else {
      await createCard(payload);
    }
    await load(page.value);
  } catch (e) {
    alert('Save failed. Check fields.');
  }
}

async function removeCard(id) {
  if (!confirm('Delete card?')) return;
  try {
    await deleteCard(id);
    await load(page.value);
  } catch (e) {
    alert('Delete failed.');
  }
}

onMounted(() => load(1));
</script>
