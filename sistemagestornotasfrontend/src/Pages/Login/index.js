import './index.css'
import usernameSvg from 'assets/icon/username.svg';
import passwordSvg from 'assets/icon/password.svg';
import {ParraphopError} from "Components/ParraphopError";
import { useEffect, useState } from 'react';
import { useNavigate } from "react-router-dom";
import { useUser } from "Hooks/useUser";
function Login() {

    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const { login, isLogged, isLoginLoading, isLoginError, messageError }  = useUser();
    const navigate = useNavigate();

    useEffect(() => {
        console.log(isLogged);
        if(isLogged) {
            navigate('/');
        }

    }, [isLogged])

    const handleClick = (e) => {
        e.preventDefault();
        login({username, password});
        console.log(username, password);
        console.log(isLoginError);
    }

    const changeUsername = (e) =>{
        setUsername(e.target.value);

    }
    const changePassword = (e) => {
        setPassword(e.target.value);
    }

    return(
        <div className="main">
            <form className = "form">
                <h1 className = "form__title">Iniciar Sesion</h1>
                <div className = "form__container">
                    <label className = "form__label" htmlFor='username'>
                        <img src={usernameSvg}
                        alt = "icon"
                        className='form__icon'/>
                    </label>
                    <input 
                        type = "text"
                        name = "username"
                        id = "username"
                        className='form__input'
                        placeholder='Username'
                        onChange={changeUsername}
                    />
                </div>
                <div className = "form__container">
                    <label className = "form__label" htmlFor='password'>
                        <img src={passwordSvg}
                        alt = "icon"
                        className='form__icon'/>
                    </label>
                    <input 
                        type = "password"
                        name = "password"
                        id = "password"
                        className='form__input'
                        placeholder='Password'
                        onChange={changePassword}
                    />
                </div>
                {isLoginError && <ParraphopError message={messageError} />}
                <div className = "form__container">
                    <button className='form__button' id = "loginButton" 
                        onClick={handleClick}
                    >
                        Login
                    </button>
                    
                </div>
            </form>

        </div>
    );

}

export {Login}
