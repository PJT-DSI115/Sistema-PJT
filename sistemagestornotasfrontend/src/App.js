import "./App.css";
import { Route, Routes } from "react-router-dom";
import { Login } from "Components/Login";
import { UserContextProvider } from "Context/UserContext";
import { PeriodoContextProvider } from "Context/PeriodoContext";
import { Home } from "Pages/Home";
import { Error403 } from "Pages/Error403";
import { Periodo } from "Components/Periodo";
import { CursosNivel } from "Components/CursoCard";
import { Footer } from "Components/Footer";
import { Actividad } from "Components/Actividad";
import { AssignTeacher } from "Components/assignTeacher";
import { Sidebar } from "Components/SideBar";
import { ListadocursoDocente } from "Components/ListadoCursosDocente";
import { Curso } from "Components/Curso";
import { ListPeriodos } from "Components/ListPeriodos";
import { Nivel } from "Components/Nivel";
import { CargaAlumnos } from "Components/CargaAlumnos";
import { CargaNotas } from "Components/CargaNotas";

function App() {
  return (
    <UserContextProvider>
      <PeriodoContextProvider>
        <div className="App">
          <div className="App-left">
            <div className="App-container">
              <Routes>
                {
                  //Principales
                }
                <Route path="/login" element={<Login />} />
                <Route path="/" element={<Home />} />
                <Route path="error403" element={<Error403 />} />

                {
                  //Routa para asignar profesores a un curso
                }
                <Route path="/asignacionDocentes" element={<ListPeriodos />}>
                  <Route path=":idPeriodo" element={<CursosNivel />}></Route>
                  <Route path=":idPeriodo">
                    <Route path=":idCursoNivel" element={<AssignTeacher />} />
                  </Route>
                </Route>

                {/**
								 Ruta para que profesores puedan gestionar
								 las actividades de los cursos que imparten
								*/}
                <Route path="/actividad" element={<ListPeriodos />}>
                  <Route
                    path=":idPeriodo"
                    element={<ListadocursoDocente />}
                  ></Route>
                  <Route path=":idPeriodo">
                    <Route path=":idCursoNivel" element={<Actividad />} />
                  </Route>
                </Route>

                {/**
								 Ruta para que profesores puedan gestionar
								 las notas de los cursos que imparten
								 */}
                <Route path="/gestionarNotas" element={<ListPeriodos />}>
                  <Route
                    path=":idPeriodo"
                    element={<ListadocursoDocente />}
                  ></Route>
                  <Route path=":idPeriodo">
                    <Route path=":idCursoNivel" element={<CargaAlumnos />} />
                  </Route>
                  <Route path=":idPeriodo">
                    <Route path=":idCursoNivel">
                      <Route path=":idCargaAcademica" element={<CargaNotas />} />
                    </Route>
                  </Route>
                </Route>

                {/**
								 Ruta para que admin gestione actividades de todos los cursos
								*/}
                <Route path="/gestionActividad" element={<ListPeriodos />}>
                  <Route path=":idPeriodo" element={<CursosNivel />}></Route>
                  <Route path=":idPeriodo">
                    <Route path=":idCursoNivel" element={<Actividad />} />
                  </Route>
                </Route>

                {/** Diferentes cruds */}
                <Route path="/gestionCursos" element={<Curso />} />
                <Route path="/gestionNiveles" element={<Nivel />} />
                <Route path="/gestionPeriodos" element={<Periodo />} />
              </Routes>
            </div>
            <Footer />
          </div>
          <div>
            <Sidebar />
          </div>
        </div>
      </PeriodoContextProvider>
    </UserContextProvider>
  );
}

export default App;
