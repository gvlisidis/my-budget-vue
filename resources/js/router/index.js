import {createRouter, createWebHistory} from "vue-router";
import Home from "../views/Home.vue";
import Expenses from "../views/Expenses.vue";
import Categories from "../views/Categories.vue";
import Ideas from "../views/Ideas.vue";
import ExpenseImport from "../views/expenses/ExpenseImport.vue";
import ExpensesIndex from "../views/expenses/ExpensesIndex.vue";
import ExpenseImportManually from "../views/expenses/ExpenseImportManually.vue";
import ExpenseEdit from "../views/expenses/ExpenseEdit.vue";
import CategoryEdit from "../views/categories/CategoryEdit.vue";
import CategoryIndex from "../views/categories/CategoryIndex.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/expenses',
            name: 'expenses',
            component: Expenses,
            children: [
                {
                    path: '',
                    name: 'expense-index',
                    component: ExpensesIndex
                },
                {
                    path: 'import-file',
                    name: 'import-file',
                    component: ExpenseImport
                },
                {
                    path: 'import-manually',
                    name: 'import-manually',
                    component: ExpenseImportManually
                },
                {
                    path: 'edit/:id',
                    name: 'expense-edit',
                    props: true,
                    component: ExpenseEdit
                }
            ]
        },
        {
            path: '/categories',
            name: 'categories',
            component: Categories,
            children: [
                {
                    path: '',
                    name: 'category-index',
                    component: CategoryIndex
                },
                {
                    path: 'edit/:id',
                    name: 'category-edit',
                    props: true,
                    component: CategoryEdit
                }
            ]
        },
        {
            path: '/ideas',
            name: 'ideas',
            component: Ideas,
        },
    ],
});
export default router;
