<script>
import axios from 'axios';

export default {
    methods: {
        async requestData(url, data = {}, method = "get") {
            try {
                if (method === "post") {
                    const response = await axios.post(url, data);
                    return response.data;
                } else if (method === "get") {
                    const response = await axios.get(url, { params: data });
                    return response.data;
                }
            } catch (error) {
                return {
                    error: true,
                    message: "Error found",
                    errors: error.response ? error.response.data : error.message,
                };
            }
        },
    },
};
</script>
