<script lang="ts" setup>
import { useQuasar } from 'quasar'
import BasePage from '@/components/BasePage.vue'
import ResidenceForm from '@/components/ResidenceForm.vue'
import ResidenceList from '@/components/ResidenceList.vue';
import type { Paginated } from '@/types/common'
import type { Residence } from '@/types/models'

const props = defineProps<{
    residences: Paginated<Residence>,
}>()

const $q = useQuasar()

const launchResidenceForm = () => {
    $q.dialog({
        component: ResidenceForm,
    })
}
</script>

<template>
    <BasePage
        title="Residences"
        heading="Residences"
        :breadcrumbs="[
            { label: 'Residences' }
        ]"
    >
        <template #actions>
            <q-btn
                no-caps
                color="primary"
                label="Add residence"
                @click="launchResidenceForm()"
            ></q-btn>
        </template>

        <template #content>
            <ResidenceList
                :residences="props.residences"
            />
        </template>
    </BasePage>
</template>
