import { render } from "react-dom";
import { Banner, Wrapper, Splash } from "../lib";

function App() {
  return (
    <div className="theme-root theme-root--white">
      <Wrapper>
        <Splash>
          <h1>
            Apple
            <br />
            ][000e
          </h1>
          <Banner>Now in React!!!</Banner>
        </Splash>
      </Wrapper>
    </div>
  );
}

render(<App />, document.getElementById("react-root"));
