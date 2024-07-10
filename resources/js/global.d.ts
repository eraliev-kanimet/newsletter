import { Alpine as AlpineType } from 'alpinejs'

declare global {
    let Alpine: AlpineType;
    interface Window {
        Alpine: AlpineType;
    }
}
