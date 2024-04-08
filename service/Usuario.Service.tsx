import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: process.env.NEXT_PUBLIC_BASE_API + "/api/usuario"
});

export class UsuarioService {
    async getLogin() {
        try {
            const response = await axiosInstance.get('/apiUsuario.php', {
                params: {
                    action: 'getLogin'
                }
            });

            // Verifica se a resposta possui a estrutura esperada
            if (response && response.data && response.data.success && response.data.result) {
                return response.data.result; // Retorna diretamente os dados de usuário
            } else {
                console.error("Estrutura de dados inválida - dados de usuários ausentes:", response);
                throw new Error("Estrutura de dados inválida - dados de usuários ausentes");
            }
        } catch (error) {
            console.error("Erro ao obter informações de usuário:", error);
            throw error;
        }
    }
}