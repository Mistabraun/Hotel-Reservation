export class PaginatedTable {

    constructor({
        table,
        endpoint,
        limit = 10,
        renderRows
    }) {

        this.table = table;
        this.endpoint = endpoint;
        this.limit = limit;
        this.renderRows = renderRows;

        this.currentPage = 1;
    }

    async load(page = this.currentPage) {

        this.currentPage = page;

        const response = await fetch(
            `${this.endpoint}?page=${page}&limit=${this.limit}`
        );

        const result = await response.json();

        if (!response.ok || !result.success) {
            return;
        }

        const rooms = result.data.items;
        const pagination = result.data.pagination;

        this.renderRows(this.table, rooms);

        this.renderPagination(pagination);
    }

    refresh() {
        return this.load(this.currentPage);
    }

    renderPagination(pagination) {

        const tfoot = this.table.querySelector("tfoot");

        tfoot.innerHTML = "";

        if (pagination.total_pages <= 1) {
            return;
        }

        const row = document.createElement("tr");

        row.innerHTML = `
            <td colspan="100%" class="bg-body-secondary">
                <nav class="d-flex justify-content-between align-items-center extra-small text-secondary-2 mx-4 py-0">

                    <span>
                        Page ${pagination.page} of ${pagination.total_pages}
                    </span>

                    <ul class="pagination mb-0">

                        <li class="page-item">
                            <button
                                class="btn btn-outline text-secondary-2 h-100 p-1 mx-2 extra-small"
                                id="table-previous">

                                <i class="fa-solid fa-arrow-left"></i>

                            </button>
                        </li>

                        <li class="page-item" id="table-pages"></li>

                        <li class="page-item">

                            <button
                                class="btn btn-outline text-secondary-2 h-100 p-1 mx-2 extra-small"
                                id="table-next">

                                <i class="fa-solid fa-arrow-right"></i>

                            </button>

                        </li>

                    </ul>

                    <span>

                        Showing
                        ${(pagination.page - 1) * pagination.limit + 1}
                        -
                        ${Math.min(
                            pagination.page * pagination.limit,
                            pagination.total_records
                        )}

                        of

                        ${pagination.total_records}

                    </span>

                </nav>
            </td>
        `;

        tfoot.appendChild(row);

        const pages = row.querySelector("#table-pages");

        for (let i = 1; i <= pagination.total_pages; i++) {

            const btn = document.createElement("button");

            btn.className =
                "btn btn-outline text-secondary-2 h-100 p-1 mx-2 extra-small";

            btn.textContent = i;

            if (i === pagination.page) {

                btn.classList.remove(
                    "btn-outline",
                    "text-secondary-2"
                );

                btn.classList.add("text-black");
            }

            btn.onclick = () => this.load(i);

            pages.appendChild(btn);
        }

        row.querySelector("#table-previous").onclick = () => {

            if (pagination.has_previous) {
                this.load(pagination.page - 1);
            }

        };

        row.querySelector("#table-next").onclick = () => {

            if (pagination.has_next) {
                this.load(pagination.page + 1);
            }

        };

    }

}