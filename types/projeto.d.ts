//d definição de tipos
declare namespace Projeto {
    type Usuario = {
        id?: number;
        nome: string;
        usuario: string;
        senha: string;
        email: string;
        [key: string]: number | string | undefined;
    };
}