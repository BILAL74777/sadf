<template>
    <button
        v-if="deleteId"
        type="button"
        class="btn btn-sm fs-6"
        data-bs-toggle="modal"
        :data-bs-target="'#deleteModal-' + deleteId"
        title="Delete"
    >
        <i class="bi bi-trash"></i>
    </button>
    <button
        v-if="participantId"
        type="button"
        class="btn btn-sm fs-6"
        data-bs-toggle="modal"
        :data-bs-target="'#participantModal-' + participantId"
        title="Delete"
    >
        <i class="bi bi-trash"></i>
    </button>
    <button
        v-if="deleteImage"
        type="button"
        class="btn btn-sm fs-6"
        data-bs-toggle="modal"
        :data-bs-target="'#eventImageDeleteModal-' + deleteImage"
        title="Delete"
    >
        <i class="bi bi-trash"></i>
    </button>
    <button
        v-if="deleteCatalog"
        type="button"
        class="btn btn-sm fs-6"
        data-bs-toggle="modal"
        :data-bs-target="'#catalogDeleteModal-' + deleteCatalog"
        title="Delete"
    >
        <i class="bi bi-trash"></i>
    </button>

    <!-- delete Modal -->
    <div class="modal fade" :id="'deleteModal-' + deleteId" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content text-center p-4">
                        <h2>
                            {{ translate("Are you sure?") }}
                        </h2>

                        <button
                            v-if="deleteId"
                            type="button"
                            class="btn btn-sm btn-success me-2"
                            data-bs-dismiss="modal"
                            @click="$emit('deleteThis', deleteId)"
                        >
                            {{ translate("Yes, delete it!") }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-dark"
                            data-bs-dismiss="modal"
                        >
                            {{ translate("Close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delete Modal -->
    <div
        class="modal fade"
        :id="'participantModal-' + participantId"
        tabindex="-1"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content text-center p-4">
                        <h2>
                            {{ translate("Are you sure?") }}
                        </h2>

                        <button
                            type="button"
                            class="btn btn-sm btn-success me-2"
                            data-bs-dismiss="modal"
                            @click="$emit('deleteParticipant', participantId)"
                        >
                            {{ translate("Yes, delete it!") }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-dark"
                            data-bs-dismiss="modal"
                        >
                            {{ translate("Close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Event  Image delete Modal -->
    <div
        class="modal fade"
        :id="'eventImageDeleteModal-' + deleteImage"
        tabindex="-1"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content text-center p-4">
                        <h2>
                            {{ translate("Are you sure?") }}
                        </h2>

                        <button
                            type="button"
                            class="btn btn-sm btn-success me-2"
                            data-bs-dismiss="modal"
                            @click="$emit('deleteImage', deleteImage)"
                        >
                            {{ translate("Yes, delete it!") }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-dark"
                            data-bs-dismiss="modal"
                        >
                            {{ translate("Close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delete Modal -->
    <div
        class="modal fade"
        :id="'catalogDeleteModal-' + deleteCatalog"
        tabindex="-1"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content text-center p-4">
                        <h2>
                            {{ translate("Are you sure?") }}
                        </h2>

                        <button
                            type="button"
                            class="btn btn-sm btn-success me-2"
                            data-bs-dismiss="modal"
                            @click="$emit('deleteCatalog', deleteCatalog)"
                        >
                            {{ translate("Yes, delete it!") }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-dark"
                            data-bs-dismiss="modal"
                        >
                            {{ translate("Close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["deleteId", "deleteImage", "deleteCatalog", "participantId"],
    emits: ["deleteThis", "deleteImage", "deleteCatalog", "deleteParticipant"],
};
</script>
