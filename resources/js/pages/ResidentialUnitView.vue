<script lang="ts" setup>
import { useQuasar } from 'quasar'
import BasePage from '@/components/BasePage.vue'
import ResidentialUnitForm from '@/components/ResidentialUnitForm.vue'
import ResidentialUnitList from '@/components/ResidentialUnitList.vue'
import type { Paginated } from '@/types/common'
import type { ResidentialUnit } from '@/types/models'

const props = defineProps<{
    residential_units: Paginated<ResidentialUnit>,
}>()

const $q = useQuasar()

const launchResidentialUnitForm = () => {
    $q.dialog({
        component: ResidentialUnitForm,
    })
}
</script>

<template>
    <BasePage
        title="Residential units"
        heading="Residential units"
        :breadcrumbs="[
            { label: 'Residences' }
        ]"
    >
        <template #actions>
            <q-btn
                no-caps
                color="primary"
                label="Add a residential unit"
                @click="launchResidentialUnitForm()"
            ></q-btn>
        </template>

        <template #content>
            <ResidentialUnitList
                :residential-units="props.residential_units"
            />
        </template>
    </BasePage>
</template>
