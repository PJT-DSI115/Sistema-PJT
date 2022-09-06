import { useState } from 'react';
import {useManagmentUser} from 'Hooks/useManagmentUser';
import './index.css';
import { ListCardUser } from './ListCardUser';
import { selectOption } from 'Service/OptionNavbar';
import { Loader } from 'Components/Loader';

function User() {

    const [option, setOption] = useState("students");

    const { users, loading } = useManagmentUser({option: option});
    const options = selectOption({value: 'userFilter'});
    


    const handleOption = (e, optionSelected) => {
        document.querySelector('.filter__button--active').classList.remove('filter__button--active');
        e.target.classList.add('filter__button--active');
        setOption(optionSelected);
    }

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
            <div className = "user__filter">
                {
                    options.map((option) => (
                        <button 
                            onClick={(e) => handleOption(e, option.option)}
                            key = {option.id}
                            className = { `filter__button ${option.active? 'filter__button--active': ''}` }
                            active = "{option.active}"
                        >
                            {option.name}
                        </button>
                    ))
                }
            </div>
            {
                loading ? <Loader />: <ListCardUser users = { users } />
            }
        </div>
    );

}

export {User}
