<script lang="ts" setup>
import {onMounted, reactive, ref} from 'vue'
import type {TableInstance} from 'element-plus'
import axios from "./plugins/axios";
import {Params, User} from "./types";

const tableRef = ref<TableInstance>()

const params = reactive<Params>({
    is_active: null,
    created_at: null,
    updated_at: null,
})

const users = ref<User[]>([])

const getUsers = async () => {
    const queryParams: Params = {}

    const fields: (keyof Params)[] = ['is_active', 'created_at', 'updated_at']

    fields.forEach(field => {
        if (params[field] !== null) {
            queryParams[field] = params[field];
        }
    });

    await axios.get('users', {params: queryParams})
        .then(response => {
            users.value = response.data
        })
}

onMounted(async () => {
    await getUsers()
})

const clearFilter = async () => {
    params.is_active = null
    params.created_at = null
    params.updated_at = null

    tableRef.value!.clearSort()

    await getUsers()
}

const filterIsActive = async (
    value: number | null,
) => {
    if (value === 2) {
        params.is_active = null
    } else {
        params.is_active = value
    }

    await getUsers()
}

const sortCustom = async (
    data: { column: object, prop: 'created_at' | 'updated_at', order: any }
) => {
    if (data.order === 'descending') {
        params[data.prop] = 1
    } else if (data.order === 'ascending') {
        params[data.prop] = 0
    } else {
        params[data.prop] = null
    }

    await getUsers()
}

const handleDelete = async (row: User) => {
    const id = row.id

    await axios.delete(`users/${id}`)
        .finally(() => {
            users.value = users.value.filter(user => user.id !== id)
        })
}

</script>

<template>
    <main class="container mx-auto">
        <h1 class="text-center text-3xl font-bold uppercase my-5">Users</h1>
        <div class="flex flex-col gap-5">
            <div class="flex gap-3">
                <el-select
                    v-model="params.is_active"
                    @change="filterIsActive"
                    placeholder="Select"
                    style="width: 240px"
                >
                    <el-option
                        v-for="item in [{label: 'All', value: 2}, {label: 'Yes', value: 1},{label: 'No', value: 0},]"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                    />
                </el-select>
                <el-button @click="clearFilter">Reset all filters</el-button>
            </div>

            <el-table @sort-change="sortCustom" ref="tableRef" row-key="date" :data="users" style="width: 100%">
                <el-table-column prop="id" label="ID" width="40"/>
                <el-table-column
                    prop="is_active"
                    label="Active"
                    width="80"
                >
                    <template #default="scope">
                        <div style="display: flex; align-items: center">
                            <el-tag :type="scope.row.is_active ? 'success' : 'danger'">
                                {{ scope.row.is_active ? 'Yes' : 'No' }}
                            </el-tag>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="name" label="Name"/>
                <el-table-column prop="email" label="Email"/>
                <el-table-column
                    prop="created_at"
                    label="Created at"
                    sortable="custom"
                    column-key="date"
                />
                <el-table-column
                    prop="updated_at"
                    label="Updated at"
                    sortable="custom"
                    column-key="date"
                />
                <el-table-column align="right">
                    <template #default="scope">
                        <el-button
                            size="small"
                            type="danger"
                            @click="handleDelete(scope.row)"
                        >
                            Delete
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </main>
</template>
