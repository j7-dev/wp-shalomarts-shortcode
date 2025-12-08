import React, { FC, useEffect } from 'react'
import { useHover } from "@uidotdev/usehooks";
import { useSetAtom } from 'jotai';
import { selectedDataAtom } from '@/pages/atom';

export const ListDataItem: FC<{
	postId: number,
	title: string,
	link: string,
	artists: string,
	location: string,
}> = ({ postId, title, link, artists, location }) => {
	const [ref, hovering] = useHover();
	const setSelectedData = useSetAtom(selectedDataAtom);

	useEffect(() => {
		if (hovering) {
			setSelectedData({
				postId,
				selectAllIcons: true,
				building: undefined,
			});
		}
	}, [hovering]);
	return (
		<a key={postId} href={link} target="_blank">
			<div ref={ref} className="sh-list-data-item ">
				<h4>{title}</h4>
				<p>{artists}</p>
				<p>{location}</p>
			</div>
		</a>
	)
}
