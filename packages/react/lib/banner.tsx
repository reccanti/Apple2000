import { useMemo } from "react";

interface Props {
  speed?: number;
}

export function Banner({ speed }: Props) {
  const style = useMemo(() => {
    let styleObj = {};
    if (speed) {
      styleObj = {
        "--banner-speed": `${speed}s`,
      };
    }
    return styleObj;
  }, [speed]);

  return (
    <div className="Banner" style={style}>
      <span className="Banner-inner">You can put all sorts of text here!</span>
    </div>
  );
}
