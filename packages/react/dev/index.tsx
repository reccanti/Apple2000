import { render } from "react-dom";
import { Banner, Wrapper, Splash } from "../lib";

function App() {
  return (
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
  );
}

render(<App />, document.getElementById("react-root"));
