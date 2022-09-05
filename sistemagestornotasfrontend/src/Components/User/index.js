import {useManagmentUser} from 'Hooks/useManagmentUser';
import './index.css';
import { ListCardUser } from './ListCardUser';

function User() {

    const { users } = useManagmentUser();
    return (
        <div className = "managment-user">
            <h1 className = "text-lg font-bold mt -10 user__title">
                Gestión de Usuarios
            </h1>
            <div className = "container__button">
                <button 
                    className = "rounded-lg bg-lime-600 px-10 py-1 text-gray-100 cursor-pointer hover:bg-line-800 mt-10 user__button"
                >
                    Registrar
                </button>
            </div>

            <ListCardUser users = { users } />
        </div>
    );

}

export {User}
