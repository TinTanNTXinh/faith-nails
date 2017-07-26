
interface ICommon {

    title: string;
    placeholder_code: string;
    prefix_url: string;
    active_index_tabview: number;

    /** Data */
    loadData(): void;
    reloadData(arr_data: any[]): void;
    refreshData(): void;
}
