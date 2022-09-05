import { getAgeByDateOfBirth } from 'Service/UserService';
import avatarDefault from "assets/image/avatar.png"

function CardUser({name, avatar, age, rol}) {


    return (
        <article className = "article">
            <header>
                <img className = "article__img" src = {avatar === "" ? avatarDefault : avatar } alt = "Avatar" />
                <h4 className = "article__title">{name}</h4>
            </header>
            <main className = "article__main">
                <p className = "article__text">Edad: {getAgeByDateOfBirth(age)}</p>
                <p className = "article__text">Rol: {rol}</p>
            </main>
            <footer>
            </footer>
        </article>
    );

}

export { CardUser }
