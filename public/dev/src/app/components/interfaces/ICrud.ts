interface ICrud {
    isEdit: boolean;

    loadOne(id: number): void;
    clearOne(): void;
    addOne(): void;
    updateOne(): void;
    deactivateOne(id: number): void;
    deleteOne(id: number): void;
    confirmDeactivateOne(id: number): void;
    validateOne(): boolean;

    displayEditBtn(status: boolean): void;
    actionCrud(obj: any): void;
}
